<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
  <div id="app">
    <section class="hero is-success is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <div class="column is-4 is-offset-4">
            <h3 class="title has-text-white">TimeClock</h3>
            <hr class="title-hr" />
            <p class="subtitle has-text-white">
              <current-time @timezone="setTimezone"/>
            </p>
            <time-table :user="user" v-model="user['clocked_in']"/>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>