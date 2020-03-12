<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
              <current-time @bla="$emit('asd')"/>
            </p>
            <div class="box">
              <div class="entry-table">
                <b-table :data="data" :columns="columns" sticky-header></b-table>
              </div>
            </div>
            <button class="button is-block is-warning is-large is-fullwidth">
              Clock In <i class="fa fa-sign-in" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
  <script>

  </script>
</body>

</html>