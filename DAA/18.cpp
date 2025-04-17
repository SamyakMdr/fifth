#include <stdio.h>
#define INF 99999
void floydWarshall(int graph[][4], int V) {
    int dist[V][V];
    int loopCount = 0;
    for (int i = 0; i < V; i++)
        for (int j = 0; j < V; j++)
            dist[i][j] = graph[i][j];
    for (int k = 0; k < V; k++) {
        for (int i = 0; i < V; i++) {
            for (int j = 0; j < V; j++) {
                loopCount++;
                if (dist[i][j] > dist[i][k] + dist[k][j])
                    dist[i][j] = dist[i][k] + dist[k][j];
            }
        }
    }
    printf("Loop Count: %d\n", loopCount);
    for (int i = 0; i < V; i++) {
        for (int j = 0; j < V; j++) {
            if (dist[i][j] == INF)
                printf("INF ");
            else
                printf("%d ", dist[i][j]);
        }
        printf("\n");
    }
}
int main() {
    int graph[4][4] = { {0, 3, INF, INF}, {2, 0, INF, INF}, {INF, 7, 0, 1}, {6, INF, INF, 0} };
    int V = 4;
    floydWarshall(graph, V);
    return 0;
}
