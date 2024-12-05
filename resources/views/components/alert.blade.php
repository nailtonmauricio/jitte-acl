@if(session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Wow!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                icon: "success",
                timer: 2000
            });
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Oops!",
                showConfirmButton: false,
                text: "{{ session('error') }}",
                icon: "error",
                timer: 2000
            });
        });
    </script>
@endif

@if(session()->has('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Atenção!",
                showConfirmButton: false,
                text: "{{ session('warning') }}",
                icon: "warning",
                timer: 2000
            });
        });
    </script>
@endif

@if(session()->has('info'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Informação",
                showConfirmButton: false,
                text: "{{ session('info') }}",
                icon: "info",
                timer: 2000
            });
        });
    </script>
@endif

{{-- Faz o loop nos erros de validação --}}
@if($errors->any())
    @php
        $messages = $errors->all();
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let delay = 0;
            @foreach ($messages as $message)
            setTimeout(() => {
                Swal.fire({
                    title: "Oops!",
                    showConfirmButton: false,
                    text: @json($message),
                    icon: "error",
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    timerProgressBar: true,
                    timer: 3000
                });
            }, delay);
            delay += 3000; // 2000ms for the toast + 100ms buffer
            @endforeach
        });
    </script>
@endif
