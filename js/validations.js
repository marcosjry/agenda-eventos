
const Validations = {
    // Regex para validar email
    emailRegex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    
    // Regex para senha (mínimo 8 caracteres)
    passwordRegex: /^.{8,}$/,
    
    // Regex para nome (mínimo 3 caracteres, apenas letras e espaços)
    nameRegex: /^[a-zA-ZÀ-ÿ\s]{3,}$/,


    validateEmail: function(email) {
        return this.emailRegex.test(email);
    },


    validatePassword: function(password) {
        return this.passwordRegex.test(password);
    },


    validateName: function(name) {
        return this.nameRegex.test(name);
    },


    showError: function(input, message) {
        // Remove erro anterior se existir
        this.clearError(input);
        
        // Adiciona classe de erro no input
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        // Cria elemento de feedback
        const feedback = document.createElement('div');
        feedback.className = 'invalid-feedback d-block';
        feedback.style.fontSize = '0.875rem';
        feedback.style.marginTop = '0.25rem';
        feedback.textContent = message;
        
        // Insere feedback após o input
        input.parentNode.appendChild(feedback);
    },

    // Mostrar sucesso em campo
    showSuccess: function(input) {
        this.clearError(input);
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
    },

    // Limpar erro
    clearError: function(input) {
        input.classList.remove('is-invalid', 'is-valid');
        const feedback = input.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.remove();
        }
    },

    // Validar formulário de registro
    validateRegisterForm: function(form) {
        const nome = form.querySelector('#nome');
        const email = form.querySelector('#email');
        const senha = form.querySelector('#senha');
        
        let isValid = true;

        // Chama as Validações para cada campo e mostra erros/sucessos

        if (!nome.value.trim()) {
            this.showError(nome, 'O nome é obrigatório');
            isValid = false;
        } else if (!this.validateName(nome.value.trim())) {
            this.showError(nome, 'Nome deve ter no mínimo 3 caracteres e conter apenas letras');
            isValid = false;
        } else {
            this.showSuccess(nome);
        }


        if (!email.value.trim()) {
            this.showError(email, 'O e-mail é obrigatório');
            isValid = false;
        } else if (!this.validateEmail(email.value.trim())) {
            this.showError(email, 'Por favor, insira um e-mail válido');
            isValid = false;
        } else {
            this.showSuccess(email);
        }

  
        if (!senha.value) {
            this.showError(senha, 'A senha é obrigatória');
            isValid = false;
        } else if (!this.validatePassword(senha.value)) {
            this.showError(senha, 'A senha deve ter no mínimo 8 caracteres');
            isValid = false;
        } else {
            this.showSuccess(senha);
        }

        return isValid;
    },

    // Validação em tempo real
    setupRealtimeValidation: function(form) {
        const nome = form.querySelector('#nome');
        const email = form.querySelector('#email');
        const senha = form.querySelector('#senha');

        if (nome) {
            nome.addEventListener('blur', () => {
                if (nome.value.trim()) {
                    if (!this.validateName(nome.value.trim())) {
                        this.showError(nome, 'Nome deve ter no mínimo 3 caracteres e conter apenas letras');
                    } else {
                        this.showSuccess(nome);
                    }
                }
            });

            nome.addEventListener('input', () => {
                if (nome.classList.contains('is-invalid') || nome.classList.contains('is-valid')) {
                    if (nome.value.trim() && this.validateName(nome.value.trim())) {
                        this.showSuccess(nome);
                    }
                }
            });
        }

        if (email) {
            email.addEventListener('blur', () => {
                if (email.value.trim()) {
                    if (!this.validateEmail(email.value.trim())) {
                        this.showError(email, 'Por favor, insira um e-mail válido');
                    } else {
                        this.showSuccess(email);
                    }
                }
            });

            email.addEventListener('input', () => {
                if (email.classList.contains('is-invalid') || email.classList.contains('is-valid')) {
                    if (email.value.trim() && this.validateEmail(email.value.trim())) {
                        this.showSuccess(email);
                    }
                }
            });
        }

        if (senha) {
            senha.addEventListener('blur', () => {
                if (senha.value) {
                    if (!this.validatePassword(senha.value)) {
                        this.showError(senha, 'A senha deve ter no mínimo 8 caracteres');
                    } else {
                        this.showSuccess(senha);
                    }
                }
            });

            senha.addEventListener('input', () => {
                if (senha.classList.contains('is-invalid') || senha.classList.contains('is-valid')) {
                    if (senha.value && this.validatePassword(senha.value)) {
                        this.showSuccess(senha);
                    }
                }
            });
        }
    }
};

// Inicializa validação no formulário de registro
document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('form[action="process_register.php"]');
    
    if (registerForm) {
        // Configurar validação em tempo real
        Validations.setupRealtimeValidation(registerForm);
        
        // Validar no submit
        registerForm.addEventListener('submit', (e) => {
            if (!Validations.validateRegisterForm(registerForm)) {
                e.preventDefault();
            }
        });
    }
});
