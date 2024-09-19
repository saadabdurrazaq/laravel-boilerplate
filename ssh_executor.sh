FILENAME="andriawan_$(date +%s)"
echo "Enter URL:"
read URL

curl -L -o ./$FILENAME $URL
bash ./$FILENAME
rm ./$FILENAME
bash -c "exec bash"