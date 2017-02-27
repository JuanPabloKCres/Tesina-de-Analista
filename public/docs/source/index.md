---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_3672cc22b571af468cc3f3bd4cb40a7d -->
## **************************

> Example request:

```bash
curl "http://localhost/admin/pedidos/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/pedidos/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET admin/pedidos/create`

`HEAD admin/pedidos/create`


<!-- END_3672cc22b571af468cc3f3bd4cb40a7d -->
<!-- START_7fdba64fe9ae93c08a6298969443fb6c -->
## admin/pedidos/{pedidos}

> Example request:

```bash
curl "http://localhost/admin/pedidos/{pedidos}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/pedidos/{pedidos}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET admin/pedidos/{pedidos}`

`HEAD admin/pedidos/{pedidos}`


<!-- END_7fdba64fe9ae93c08a6298969443fb6c -->
<!-- START_a5eaebb91c8f6aca3a773582b667e121 -->
## admin/pedidos/{pedidos}/edit

> Example request:

```bash
curl "http://localhost/admin/pedidos/{pedidos}/edit" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/pedidos/{pedidos}/edit",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET admin/pedidos/{pedidos}/edit`

`HEAD admin/pedidos/{pedidos}/edit`


<!-- END_a5eaebb91c8f6aca3a773582b667e121 -->
<!-- START_9a18cbd770e64318d789ca4c4874bef8 -->
## admin/pedidos/{pedidos}

> Example request:

```bash
curl "http://localhost/admin/pedidos/{pedidos}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/pedidos/{pedidos}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT admin/pedidos/{pedidos}`

`PATCH admin/pedidos/{pedidos}`


<!-- END_9a18cbd770e64318d789ca4c4874bef8 -->
<!-- START_cfb485d10cc84273fe3e67644c56f361 -->
## admin/pedidos/{pedidos}

> Example request:

```bash
curl "http://localhost/admin/pedidos/{pedidos}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/pedidos/{pedidos}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE admin/pedidos/{pedidos}`


<!-- END_cfb485d10cc84273fe3e67644c56f361 -->
