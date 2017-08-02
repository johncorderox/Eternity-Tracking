<h1>Security Functions</h1>

## trims
Operation: Secures form inputs from various SQL Injections/attacks.

Within the system, there are numerous places that utilize the built in <b>trims</b>function.
Usage:
```php

// Variable Trimming
trims($yourVariable);

// POST/GET Trimming
trims($_POST['yourVariable']);
```

Trims utilizing the following form handling procedures:
<li>trim</li> - Removes Whitespaces
<li>stripslahses</li> - Removes Backslashes
<li>htmlspecialcharacters</li> - Converts to HTML Entities
<li>striptags</li> - Removes PHP/HTML Tags

## email_clean

Operation: Sanitizes strings and cleans for email verification.

Usage:
```php

  $your_Email = "ete(rnity).trac///kin/(g)@admin/.c/om";

  email_clean($your_Email);

```
