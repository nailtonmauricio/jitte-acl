<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Objeto centralizado para gerenciar alertas
        const Alert = {
            // Função para exibir um alerta padrão
            showAlert: (text, icon) => {
                Swal.fire({
                    text: text,
                    icon: icon,
                    showConfirmButton: false,
                    timer: 5000
                });
            },

            // Função para exibir um toast
            showToast: (title, icon) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                Toast.fire({
                    icon: icon,
                    title: title
                });
            },

            // Função para exibir um loader
            showLoading: () => {
                Swal.fire({
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
            },

            // Função para fechar qualquer alerta/loader
            close: () => {
                Swal.close();
            }
        };

        // Sessões gerenciadas de forma dinâmica
        const sessions = {
            success: "{{ session('success') }}",
            toastSuccess: "{{ session('toastSuccess') }}",
            error: "{{ session('error') }}",
            warning: "{{ session('warning') }}",
            info: "{{ session('info') }}",
            toastInfo: "{{ session('toastInfo') }}"
        };

        // Verifica cada sessão e exibe o alerta/toast apropriado
        Object.entries(sessions).forEach(([key, value]) => {
            if (value) {
                if (key.startsWith('toast')) {
                    Alert.showToast(value, key.replace('toast', '').toLowerCase());
                } else {
                    Alert.showAlert(value, key.toLowerCase());
                }
            }
        });

        // Exibição de erros de validação
        @if($errors->any())
        const messages = @json($errors->all());
        let delay = 0;

        messages.forEach((message) => {
            setTimeout(() => {
                Alert.showToast(message, 'error');
            }, delay);
            delay += 5000;
        });
        @endif
    });
</script>
