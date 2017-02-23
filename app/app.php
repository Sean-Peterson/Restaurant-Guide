<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";


    $app = new Silex\Application();

    $app['debug'] = true;


    $server = 'mysql:host=localhost:8889;dbname=restaurant_guide';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/", function() use ($app) {
        $add_cuisine = new Cuisine($_POST['new_cuisine']);
        $add_cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->delete("/{id}", function($id) use ($app) {
        $this_cuisine = Cuisine::findCuisine($id);
        $this_cuisine->deleteCuisine();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisine_type/{id}", function($id) use ($app) {
        $restaurants = Restaurant::findRestaurantByProperty("id_cuisine",$id);
        $this_cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $this_cuisine, 'restaurants'=>$restaurants));
    });

    $app->delete("/cuisine_type/{id_cuisine}/{id_restaurant}", function($id_cuisine,$id_restaurant) use ($app) {
        $restaurant = Restaurant::findRestaurant($id_restaurant);
        $restaurant->deleteRestaurant();
        $restaurants = Restaurant::findRestaurantByProperty("id_cuisine",$id_cuisine);
        $this_cuisine = Cuisine::findCuisine($id_cuisine);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $this_cuisine, 'restaurants'=>$restaurants));
    });

    $app->post("/cuisine_type/{id}/add", function($id) use ($app) {
        $add_restaurant = new Restaurant($_POST['name'], $_POST['price'], $_POST['description'], $_POST['id_cuisine']);
        $add_restaurant->save();
        $restaurants = Restaurant::findRestaurantByProperty("id_cuisine",$id);
        $this_cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $this_cuisine, 'restaurants'=>$restaurants));
    });

    $app->get("/restaurant/{id}", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        $id_cuisine = $restaurant->getIdCuisine();
        $cuisine = Cuisine::findCuisine($id_cuisine);
        return $app['twig']->render('restaurant.html.twig', array('restaurant'=>$restaurant, 'cuisine'=>$cuisine));
    });

    $app->patch("/restaurant/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        $id_cuisine = $restaurant->getIdCuisine();
        $cuisine = Cuisine::findCuisine($id_cuisine);
        $restaurant->updateProperty("restaurant_name",$_POST['name']);
        $restaurant->updateProperty("price",$_POST['price']);
        $restaurant->updateProperty("description",$_POST['description']);
        return $app['twig']->render('restaurant.html.twig', array('restaurant'=>$restaurant, 'cuisine'=>$cuisine));
    });

    $app->get("/restaurant/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::findRestaurant($id);
        $id_cuisine = $restaurant->getIdCuisine();
        $cuisine = Cuisine::findCuisine($id_cuisine);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant'=>$restaurant, 'cuisine'=>$cuisine));
    });

    $app->get("/cuisine_type/{id}/edit", function($id) use ($app) {
        $this_cuisine = Cuisine::findCuisine($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $this_cuisine));
    });

    $app->patch("/cuisine_type/{id}/edit", function($id) use ($app) {
        $this_cuisine = Cuisine::findCuisine($id);
        $this_cuisine->updateProperty('cuisine_name',$_POST['name']);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $this_cuisine));
    });


    return $app;
?>
