#include <stdio.h>
#include <stdlib.h>
#include <mysql/mysql.h>

int main() {
    MYSQL *conn;
    MYSQL_RES *res;
    MYSQL_ROW row;

    char *server = "localhost";
    char *user = "root";
    char *password = ""; // your MySQL password
    char *database = "cafedb";

    conn = mysql_init(NULL);
    if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
        fprintf(stderr, "%s\n", mysql_error(conn));
        exit(1);
    }

    char name[50];
    int item, qty;

    printf("Enter Customer Name: ");
    scanf("%s", name);
    printf("Enter Item Number (from 1 to 4): ");
    scanf("%d", &item);
    printf("Enter Quantity: ");
    scanf("%d", &qty);

    char query[256];
    sprintf(query, "INSERT INTO orders (customer_name, item_id, quantity) VALUES ('%s', %d, %d)", name, item, qty);

    if (mysql_query(conn, query)) {
        fprintf(stderr, "%s\n", mysql_error(conn));
    } else {
        printf("✅ Order placed successfully!\n\n");
    }

    // 🔽 Fetch and display all orders
    printf("🧾 Current Orders:\n");
    if (mysql_query(conn, "SELECT * FROM orders")) {
        fprintf(stderr, "%s\n", mysql_error(conn));
        exit(1);
    }

    res = mysql_store_result(conn);
    int num_fields = mysql_num_fields(res);

    while ((row = mysql_fetch_row(res))) {
        for (int i = 0; i < num_fields; i++) {
            printf("%s\t", row[i] ? row[i] : "NULL");
        }
        printf("\n");
    }

    mysql_free_result(res);
    mysql_close(conn);
    return 0;
}
