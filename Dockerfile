FROM bitnami/laravel:latest
WORKDIR /api-restaurant
ARG PORT_BULD=8000
ENV PORT=${PORT_BULD}
EXPOSE ${PORT_BULD}
COPY . .
RUN php artisan db:seed --class=DatabaseSeeder
ENTRYPOINT php artisan serve