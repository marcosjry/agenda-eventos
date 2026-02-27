// Funções de feedback simples
document.addEventListener('DOMContentLoaded', () => {
    console.log('Sistema de Agenda de Eventos carregado.');
    
    // Confirmação para botões de excluir
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            if (!confirm('Deseja realmente realizar esta ação?')) {
                e.preventDefault();
            }
        });
    });

    // Sistema de busca com dropdown
    const dropdownItems = document.querySelectorAll('#dropdownTipoBusca + .dropdown-menu .dropdown-item');
    const textoTipoBusca = document.getElementById('textoTipoBusca');
    const tipoBuscaInput = document.getElementById('tipo_busca');
    const termoBuscaTexto = document.getElementById('termo_busca_texto');
    const termoBuscaData = document.getElementById('termo_busca_data');
    const formBusca = document.getElementById('formBusca');
    const listaEventos = document.getElementById('lista-eventos');
    const feedbackBusca = document.getElementById('feedback-busca');
    const contagemEventos = document.getElementById('contagem-eventos');
    const statusCarregamento = document.getElementById('status-carregamento');

    if (dropdownItems.length > 0 && textoTipoBusca && tipoBuscaInput && termoBuscaTexto && termoBuscaData) {
        
        let timeoutBusca = null;

        const realizarBuscaAjax = () => {
            const tipo = tipoBuscaInput.value;
            const termo = tipo === 'data' ? termoBuscaData.value : termoBuscaTexto.value;

            // Mostrar carregando
            if (statusCarregamento) statusCarregamento.classList.remove('d-none');
            
            const params = new URLSearchParams({
                tipo_busca: tipo,
                termo_busca: termo
            });

            fetch(`../events/search_ajax.php?${params.toString()}`)
                .then(response => response.text())
                .then(html => {
                    if (listaEventos) {
                        listaEventos.innerHTML = html;
                        
                        // Atualizar feedback visual
                        const numEventos = listaEventos.querySelectorAll('.col').length;
                        const hasNoResultsAlert = listaEventos.querySelector('.alert-info');
                        
                        if (termo !== '') {
                            feedbackBusca.classList.remove('d-none');
                            if (hasNoResultsAlert) {
                                contagemEventos.innerHTML = `<span class="text-danger">Nenhum evento encontrado para "<strong>${termo}</strong>"</span>`;
                            } else {
                                contagemEventos.innerHTML = `<span class="text-success">${numEventos} evento(s) encontrado(s)</span>`;
                            }
                        } else {
                            feedbackBusca.classList.add('d-none');
                        }
                    }
                })
                .catch(error => console.error('Erro na busca:', error))
                .finally(() => {
                    if (statusCarregamento) statusCarregamento.classList.add('d-none');
                });
        };

        const debounceBusca = () => {
            clearTimeout(timeoutBusca);
            timeoutBusca = setTimeout(realizarBuscaAjax, 300);
        };

        // Eventos para disparar busca
        termoBuscaTexto.addEventListener('input', debounceBusca);
        termoBuscaData.addEventListener('change', realizarBuscaAjax);
        
        if (formBusca) {
            formBusca.addEventListener('submit', (e) => {
                e.preventDefault();
                realizarBuscaAjax();
            });
        }

        dropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active de todos
                dropdownItems.forEach(i => i.classList.remove('active'));
                
                // Adiciona active no clicado
                this.classList.add('active');
                
                // Atualiza texto do botão
                const novoTexto = this.getAttribute('data-texto');
                const novoTipo = this.getAttribute('data-tipo');
                
                textoTipoBusca.textContent = novoTexto;
                tipoBuscaInput.value = novoTipo;
                
                // Alterna entre campos de busca
                if (novoTipo === 'data') {
                    termoBuscaTexto.style.display = 'none';
                    termoBuscaTexto.value = '';
                    termoBuscaData.style.display = 'block';
                    termoBuscaData.focus();
                } else if (novoTipo === 'titulo' || novoTipo === 'descricao') {
                    termoBuscaData.style.display = 'none';
                    termoBuscaData.value = '';
                    termoBuscaTexto.style.display = 'block';
                    termoBuscaTexto.placeholder = novoTipo === 'descricao' ? 'Buscar por descrição...' : 'Buscar evento...';
                    termoBuscaTexto.focus();
                } else {
                    // Todos - mostra campo de texto
                    termoBuscaData.style.display = 'none';
                    termoBuscaData.value = '';
                    termoBuscaTexto.style.display = 'block';
                    termoBuscaTexto.value = '';
                    termoBuscaTexto.placeholder = 'Buscar evento...';
                    termoBuscaTexto.focus();
                }

                // Disparar busca ao mudar tipo se houver termo
                realizarBuscaAjax();
            });
        });

        // Botão limpar busca
        const btnLimparBusca = document.getElementById('btnLimparBusca');
        if (btnLimparBusca) {
            btnLimparBusca.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('🧹 Limpar busca clicado');
                
                // Limpar campos
                termoBuscaTexto.value = '';
                termoBuscaData.value = '';
                
                // Resetar dropdown para "Todos"
                dropdownItems.forEach(i => i.classList.remove('active'));
                dropdownItems[0].classList.add('active'); // "Todos"
                textoTipoBusca.textContent = '';
                
                // Esconder feedback
                if (feedbackBusca) feedbackBusca.classList.add('d-none');
                
                // Buscar todos os eventos
                realizarBuscaAjax();
            });
        }
        
    }
});
