#!/bin/bash

# Chạy migration
php artisan migrate --force

# Chạy lệnh tiếp theo (thường là start server apache)
exec "$@"
