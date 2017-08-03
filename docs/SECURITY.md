<h1>Security Functions</h1>

## trims
Operation: Secures form inputs from various SQL Injections/attacks.

Within the system, there are numerous places that utilize the built in <b>trims</b> function.<br>
Usage:
```php

// Variable Trimming
trims($yourVariable);

// POST/GET Trimming
trims($_POST['yourVariable']);
```

Trims utilizing the following form handling procedures:
<li>trim - Removes Whitespaces</li>
<li>stripslahses - Removes Backslashes</li>
<li>htmlspecialcharacters - Converts to HTML Entities</li>
<li>striptags - Removes PHP/HTML Tags</li>

## email_clean

Operation: Sanitizes strings and cleans for email verification.

Usage:
```php

  $your_Email = "ete(rnity).trac///kin/(g)@admin/.c/om";

  email_clean($your_Email);
  echo $your_Email; // eternitytracking@admin.com

```
