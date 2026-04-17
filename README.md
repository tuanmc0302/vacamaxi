# Embera

Laravel 11 project duoc to chuc theo huong Clean Architecture de tach ro frontend va backend.

## Luong xu ly

- Frontend: `web route -> presentation controller -> blade/view -> HTML response`
- Backend: `api route -> presentation controller -> application use case -> domain contract -> infrastructure adapter -> JSON response`

## Cau truc thu muc

```text
app/
|-- Application/
|-- Domain/
|-- Infrastructure/
`-- Presentation/

routes/
|-- web.php
`-- api.php

resources/views/
`-- frontend/
```

## Quy uoc layer

### Domain

Chua contract, entity, value object va business rule cot loi. Layer nay nen han che phu thuoc framework.

### Application

Chua use case, DTO, command/query va business flow. Layer nay lam viec thong qua contract cua Domain.

### Infrastructure

Chua implementation cho contract nhu repository, cache, queue, mail, filesystem, third-party service.

### Presentation

Chua controller, request, response resource, blade view va giao tiep truc tiep voi client.

## Route mau

- `/` cho frontend
- `/admin` cho admin auth UI
- `/admin/dashboard` cho admin panel sau khi dang nhap
- `/api/v1/system/status` cho backend API
- `/up` cho health check

## Cach them feature moi

1. Tao contract trong `Domain/<Feature>/Contracts`
2. Tao use case trong `Application/<Feature>/UseCases`
3. Tao implementation trong `Infrastructure/...`
4. Tao controller trong `Presentation/Http/Controllers/Frontend` hoac `Presentation/Http/Controllers/Api/V1`
5. Bind interface voi implementation tai `app/Providers/AppServiceProvider.php`
