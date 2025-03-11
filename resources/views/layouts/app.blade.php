<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление подписками</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/vue@3"></script>
</head>
<body>
    <div id="app">
        <div v-if="show" :class="notificationClass" class="fixed top-4 right-4 px-4 py-3 rounded">
            @if(session('success'))
                {{ session('success') }}
            @endif

            @if(session('error')) 
                {{ session('error') }}
            @endif
        </div>
        
        @yield('content')
        
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    show: false,
                    type: 'success',
                    message: ''
                };
            },
            computed: {
                notificationClass() {
                    return {
                        'bg-green-100 border border-green-400 text-green-700': this.type === 'success',
                        'bg-red-100 border border-red-400 text-red-700': this.type === 'error',
                    };
                }
            },
            methods: {
                notify(type, message) {
                    this.type = type;
                    this.message = message;
                    this.show = true;
                    setTimeout(() => {
                        this.show = false;
                    }, 3000); // Уведомление исчезнет через 3 секунды
                }
            },
            mounted() {
                // Отображение уведомлений из сессий
                @if(session('success'))
                    this.notify('success', '{{ session('success') }}');
                @endif

                @if(session('error'))
                    this.notify('error', '{{ session('error') }}');
                @endif

            }
        }).mount('#app');
    </script>

</body>
</html>