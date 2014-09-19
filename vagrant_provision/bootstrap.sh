if [ -f "/.bootstrap.done" ]; then
    exit
fi

## Ставим необходимые пакеты

add-apt-repository --enable-source "deb http://archive.ubuntu.com/ubuntu trusty multiverse"
add-apt-repository --enable-source "deb http://archive.ubuntu.com/ubuntu trusty-updates multiverse"
add-apt-repository --enable-source "deb http://security.ubuntu.com/ubuntu trusty-security multiverse"

echo "Updating packages list ..."
DEBIAN_FRONTEND=noninteractive aptitude --quiet=3 update

echo "Installing Ubuntu packages ..."
DEBIAN_FRONTEND=noninteractive aptitude -y install php5 php5-json php5-mysql mysql-server

rm /etc/apache2/sites-enabled/*
ln -s /vagrant/vagrant_provision/app.conf /etc/apache2/sites-enabled/app.conf
service apache2 restart

touch /.bootstrap.done