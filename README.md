# API REST using PHP

## Course Overview

In this course, I learn how to develop and implement REST services, including GET, POST, DELETE, and PUT, as well as how to implement authentication and error handling.

* Learn to consume REST services
* Produce REST services
* Restrict acces to REST APIs

## Course Outline

1. Class 5: How to make a REST request and interpret its results
    * xkcd.php

2. Class 6: Expose data through HTTP GET
    * server.php

3. Class 7: Expose a particular resource via HTTP GET
    * router.php

4. Class 8: Embed data via HTTP POST
    * server.php

5. Class 9: Modify data via HTTP PUT
    * server.php

6. Class 10: Delete data via HTTP DELETE
    * server.php

7. Class 11: Authentication via HTTP
    * server.php

8. Class 12: Authentication via HMAC
    * to use this authentication you must sent the UID, TIMESTAMP and HASH
    * run generate_hash to obtain the TIMESTAMP and HASH
    * then use the next command -> curl [url] -H 'X-UID: #' -H 'X-TIMESTAMP: #' -H 'X-HASH: #'

9. Class 13: Authentication via Access Tokens
    * run the authentication server on port 8001 and the API server on port 8000
    * then ask for the token using -> curl http://localhost:8001 -X 'GET' -H 'Client-Id: 1' -H 'X-Secret: SuperSecreto!'
    * make the request to the server using the given token -> curl http://localhost:8000 -H 'X-Token: ####'

10. Class : ...
    * ...

## Conclusion

We are not here yet!!