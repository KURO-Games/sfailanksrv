FROM centos:latest

RUN yum -y update && yum -y install httpd
RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm

RUN dnf -y install dnf-utils
RUN dnf -y module reset php
RUN dnf -y module install php:remi-7.4

RUN dnf install -y php-mcrypt php-pdo php-bcmath php-tokenizer php-xml php-mysqlnd php-gd php-intl php-zip php-opcache php-pecl-xdebug
ENTRYPOINT ["/usr/sbin/httpd", "-DFOREGROUND"]

CMD ["chown","-R","apache:apache","/var/www/html/storage"
CMD ["chown","-R","apache:apache","/var/www/html/bootstrap/cache"

#WORKDIR /var/www/html
#CMD ["php","artisan","serve","--host","0.0.0.0"]
