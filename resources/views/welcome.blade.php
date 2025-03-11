<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - управление подписками</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
  <div class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center">
    <div class="mx-auto max-w-xl text-center">
      <h1 class="text-3xl font-extrabold sm:text-5xl">
        Управление подписками
        <strong class="font-extrabold text-blue-700 sm:block"> Наведение порядка. </strong>
      </h1>

      <p class="mt-4 sm:text-xl/relaxed">
        Наведите порядок во всех ваших подписках.
      </p>

      <div class="mt-8 flex flex-wrap justify-center gap-4">
      @auth

        <a
          class="block w-full rounded-sm bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:ring-3 focus:outline-hidden sm:w-auto"
          href="{{ route('profile') }}"
        >
          Профиль
        </a>

        <a
          class="block w-full rounded-sm px-12 py-3 text-sm font-medium text-blue-600 shadow-sm hover:text-red-700 focus:ring-3 focus:outline-hidden sm:w-auto"
          href="{{ route('logout') }}"
        >
          Выход
        </a>

        @else

        <a
          class="block w-full rounded-sm bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:ring-3 focus:outline-hidden sm:w-auto"
          href="{{ route('login') }}"
        >
          Войти
        </a>

        <a
          class="block w-full rounded-sm px-12 py-3 text-sm font-medium text-blue-600 shadow-sm hover:text-red-700 focus:ring-3 focus:outline-hidden sm:w-auto"
          href="{{ route('register') }}"
        >
          Регистрация
        </a>
        @endauth
      </div>
    </div>
  </div>

</body>
</html>



