// admin_view.c
#include <stdio.h>
#include <mysql/mysql.h>

int main() {
    MYSQL *conn;
    MYSQL_RES *res;
    MYSQL_ROW row;

    conn = mysql_init(NULL);
    mysql_real_connect(conn, "localhost", "root", "", "cafedb", 0, NULL, 0);

    if (mysql_query(conn, "SELECT * FROM orders")) {
        fprintf(stderr, "%s\n", mysql_error(conn));
        return 1;
    }

    res = mysql_use_result(conn);
    printf("Order ID | Customer | Item ID | Qty | Time\n");

    while ((row = mysql_fetch_row(res)) != NULL) {
        printf("%s\t%s\t%s\t%s\t%s\n", row[0], row[1], row[2], row[3], row[4]);
    }

    mysql_free_result(res);
    mysql_close(conn);
    return 0;
}
