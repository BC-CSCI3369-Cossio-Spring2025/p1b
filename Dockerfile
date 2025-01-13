# Use PHP 8.2 Apache base image
FROM php:8.2-apache

# Install Python and required dependencies
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    && rm -rf /var/lib/apt/lists/*

# Copy PHP files to Apache's default directory
COPY *.php /var/www/html/
COPY *.css /var/www/html/

# Copy Python script
COPY pd.py /app/
WORKDIR /app

# Install Python dependencies (if you have any requirements.txt)
# COPY requirements.txt .
# RUN pip3 install -r requirements.txt

# Configure Apache to handle Python scripts
RUN a2enmod proxy_fcgi

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
