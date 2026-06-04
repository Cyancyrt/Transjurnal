<header
class="bg-white shadow px-8 py-4 flex justify-between items-center">

    <div>

        <h2 class="font-semibold text-lg">
            Welcome,
            {{ auth()->user()->name }}
        </h2>

    </div>

    <form method="POST"
          action="{{ route('logout') }}">

        @csrf

        <button
        class="bg-red-500 text-white px-4 py-2 rounded">

            Logout

        </button>

    </form>

</header>