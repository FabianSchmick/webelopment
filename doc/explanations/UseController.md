# How to develop controllers?

This section explains how to develop controllers:


* For an example look in */examples/controller.examples.php*
    * As file name use something like: `StarWarsController.php`
        * For more order you can use subdirectories, too.
          Something like `movies/scifi/StarWarsController.php`
          But don't forget to update the namespace in the controller itself and the `'controller'` in *app/config/routes.inc.php*
    * The controller extends the class Controller: `class StarWarsController extends Controller`
    * `indexAction()` is like a main method, this handles the complete page rendering
    * `return $this->renderTpl(star_wars.tpl.php)` will render the page
    * You can pass optional parameters to the template, too: `return $this->renderTpl(star_wars.tpl.php, ['var' => 'force'])`
        * These parameters can be called in the template with plain php `$this->values['var']` or shorthand `[$var]`