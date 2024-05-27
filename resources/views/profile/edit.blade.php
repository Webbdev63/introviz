
@include('layouts.header');

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

  @include('layouts.sidebar');



  <section>
      <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              Profile Information
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Update your account's profile information and email address.
          </p>
      </header>

      <form id="send-verification" method="post" action="https://introviz.teaserstaging.com/email/verification-notification">
          <input type="hidden" name="_token" value="sqdvGfaevEcRfM5tyZVEfm8XGt0QSZoDd8y6fSyb" autocomplete="off">    </form>

      <form method="post" action="https://introviz.teaserstaging.com/profile" class="mt-6 space-y-6">
          <input type="hidden" name="_token" value="sqdvGfaevEcRfM5tyZVEfm8XGt0QSZoDd8y6fSyb" autocomplete="off">        <input type="hidden" name="_method" value="patch">
          <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">
      Name
  </label>
              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="virender" required="required" autofocus="autofocus" autocomplete="name">
                      </div>

          <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
      Email
  </label>
              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="email" name="email" type="email" value="virender@gmail.com" required="required" autocomplete="username">

                      </div>

          <div class="flex items-center gap-4">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
      Save
  </button>

                      </div>
      </form>
  </section>

          @include('layouts.footer');







<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
