<!DOCTYPE html>
<html>
  <head>
    <title>Vue vue-slim-tabs DEMO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div id="app">
        {{message}}
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script>
      Vue.createApp({
        data(){
            return {
                message: 'Hello World!'
            }
        }
      }).mount('#app')
    </script>
  </body>
</html>