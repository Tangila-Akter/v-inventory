<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Vue Inventory</title>
</head>
<body>
    <div id="app">
        <!-- Vue Router will render components here -->
        <router-view></router-view>
    </div>

    <!-- Include Vue.js and Vue Router -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
