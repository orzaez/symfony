echo "Haciendo dump de la BD..."
echo "" 
php app/console doctrine:schema:update --dump-sql 
echo "" 
echo "No olvides ejecutar el comando para aplicar cambios"
echo ""
echo "php app/console doctrine:schema:update --force"
echo ""
