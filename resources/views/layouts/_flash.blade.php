<script>
    @foreach (['danger', 'warning', 'success', 'info', 'error', 'warning'] as $msg)
        @if(Session::has('alert-' . $msg))
            $(document).ready(function() {
                Swal.fire({
                    title: "{{ preg_replace('/[\r\n]+/', ' ', Session::get('alert-' . $msg)) }}",
                    icon: "{{ $msg }}",
                    allowOutsideClick: true,
                    confirmButtonColor: '#308AF3',
                    confirmButtonText: "{{ __('messages.ok') }}"
                })
            }); 
        @endif
    @endforeach
</script>