#include <stdio.h>
#include <limits.h>
#define V 5
int minKey(int key[], int mstSet[], int* loopCount) {
    int min = INT_MAX, min_index;
    for (int v = 0; v < V; v++) {
        (*loopCount)++;
        if (!mstSet[v] && key[v] < min) {
            min = key[v];
            min_index = v;
        }
    }
    return min_index;
}
void primMST(int graph[V][V], int* loopCount) {
    int parent[V], key[V], mstSet[V];
    for (int i = 0; i < V; i++) {
        key[i] = INT_MAX;
        mstSet[i] = 0;
        (*loopCount)++;
    }
    key[0] = 0;
    parent[0] = -1;
    for (int count = 0; count < V - 1; count++) {
        (*loopCount)++;
        int u = minKey(key, mstSet, loopCount);
        mstSet[u] = 1;
        for (int v = 0; v < V; v++) {
            (*loopCount)++;
            if (graph[u][v] && !mstSet[v] && graph[u][v] < key[v]) {
                parent[v] = u;
                key[v] = graph[u][v];
            }
        }
    }
    printf("Edge \tWeight\n");
    for (int i = 1; i < V; i++) {
        printf("%d - %d \t%d\n", parent[i], i, graph[i][parent[i]]);
    }
}
int main() {
    int graph[V][V] = {
        { 0, 2, 0, 6, 0 },
        { 2, 0, 3, 8, 5 },
        { 0, 3, 0, 0, 7 },
        { 6, 8, 0, 0, 9 },
        { 0, 5, 7, 9, 0 },
    };
    int loopCount = 0;
    primMST(graph, &loopCount);
    printf("Number of loops: %d\n", loopCount);
    return 0;
}
