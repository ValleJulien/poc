clone the project


run the start script start.sh


docker-compose exec php bash


run composer install

If you have some troubleshooting with composer installation packagist bundles i-e Getting zlib_decode(): data error when trying to composer install or require <package-name> ...

run this command composer self-update --update-keys

ollowing the instructions (going to https://composer.github.io/pubkeys.html) then enter the Dev / Snapshot Public Key and Tags Public Key 

This issue prevent about force ipv4 instead ipv6 for download packagist bundles

You could run the following command in container:
   sysctl -w net.ipv6.conf.all.disable_ipv6=1 \
   sysctl -w net.ipv6.conf.all.autoconf=0 \
   sysctl -w net.ipv6.conf.default.disable_ipv6=1 \
   sysctl -w net.ipv6.conf.default.autoconf=0


normally the container is running so you could may have some permissions errors
manage permissions Using ACL on a System that Supports setfacl (Linux/BSD)

HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var

