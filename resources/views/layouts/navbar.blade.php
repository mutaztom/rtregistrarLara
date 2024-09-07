<nav class="flex flex-row sm:flex-row sm:justify-end gab-5">
    <a href="{{ url('/') }}"
        class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
        {{__('Home')}}
    </a>
   
    <a href="{{ url('/registration-guide') }}"
        class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
        {{__('Registration Guide')}}
    </a>
    <a href="{{ url('/resources') }}"
        class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
        {{__('Resources')}}
    </a>
    <a href="{{ url('/courses') }}"
        class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
        {{__('Courses')}}
    </a>
</nav>
