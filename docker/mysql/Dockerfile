# FROM mysql:8

# # Copy custom my.cnf configuration file
# COPY my.cnf /etc/mysql/my.cnf

# # Copy the custom configuration file into the container
# # COPY configs/mysql8/my.cnf /etc/mysql/my.cnf
# # COPY docker /configs

# # Set the correct permissions for configuration files
# # RUN chmod -R 644 /configs/mysql8/my.cnf

# # Copy the custom configuration file into the container
# # RUN mv /configs/mysql8/my.cnf /etc/mysql/my.cnf

# # Remove the copied configs directory if not needed
# # RUN rm -rf /configs

# # Set the correct permissions for the configuration file
# RUN chmod 644 /etc/mysql/my.cnf

# # Set the entrypoint to start the MySQL server
# ENTRYPOINT ["docker-entrypoint.sh"]

# # Set the default command to start the MySQL server
# CMD ["mysqld"]

FROM mysql:8

# Copy the custom configuration file into the container
COPY my.cnf /etc/mysql/my.cnf

# Set the correct permissions for the configuration file
RUN chmod 644 /etc/mysql/my.cnf

# Copy the init.sql script to the Docker entrypoint init.d directory
COPY init.sql /docker-entrypoint-initdb.d/

# Set the entrypoint to start the MySQL server
ENTRYPOINT ["docker-entrypoint.sh"]

# Set the default command to start the MySQL server
CMD ["mysqld"]
