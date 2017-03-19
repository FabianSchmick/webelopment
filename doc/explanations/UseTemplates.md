# How to use Templates?

This section explains how to use the integrated templates:

* For an example look in */examples/template.examples.php*
    * For simple display of a variable use `[@var]`
    
    * If you want to use control statements like `if`, `for`, `foreach` and so on,
      you have to use `<?php ... ?>` tags.
        * Inside the php tags you cant use the template `[@var]` convention.
        * Here you can only access the variables by `$this->values['var']`.
