# TODO List API Documentation

Response Schema:
JSON OBJECT {"success": Boolean, "message_code": String, "body": Array}

GET /sales_api

- GET all items name in database
- Request arguments: none
- 404 - No item was found


GET /sales_api/git_transaction

- GET all transactions in database
- Request arguments: none
- 404 - No item was found


POST /sales_api/quantity

- GET information of the selected item
- Request arguments: {"id": Integer}
- 422 - if id param was not provided
- 404 - No item was found


POST /sales_api/create_transaction

- Create new transaction in two table
- Request arguments: {"item_id": Integer , "total":Integer ,"quntity_item":Integer}
- 422 - if item_id param was not provided
- 404 - No item was found



POST /sales_api/edit_transaction

- GET information of the selected item to be edit
- Request arguments: {"id": Integer }
- 422 - if id param was not provided
- 404 - No item was found



PUT /sales_api/save_update_transaction

- Save edit transaction in two table.
- Request arguments: {"item_id": Integer , "total":Integer ,"quntity_item":Integer}
- 422 - if id param was not provided
- 404 - No item was found



DELETE /sales_api/delete_transaction

- delete transaction selected in two table
- Request arguments: {"id": Integer}
- 422 - if id param was not provided
- 404 - if item was not found
