FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libxslt-dev \
    zip \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl xsl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files and install dependencies
COPY ./composer.json ./composer.lock ./
RUN composer install --no-scripts

# Copy application files
COPY . .
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Create laravel user and set permissions
RUN addgroup --gid 1000 laravel
RUN adduser --ingroup laravel --shell /bin/sh laravel

# Ensure log directory exists and set permissions
RUN mkdir -p /var/log/supervisor \
    && chown -R laravel:laravel /var/log/supervisor

# Add Supervisor configuration
COPY ./supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Expose port 9000
EXPOSE 9000

# Copy and run the start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh
CMD ["/usr/local/bin/start.sh"]

# Switch to laravel user
USER laravel
