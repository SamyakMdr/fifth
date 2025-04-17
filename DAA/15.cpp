#include <stdio.h>
#include <stdlib.h>
#define MAX 100
typedef struct {
    int u, v, weight;
} Edge;
int findParent(int parent[], int i) {
    if (parent[i] == -1) return i;
    return findParent(parent, parent[i]);
}
void unionSets(int parent[], int rank[], int x, int y) {
    int xroot = findParent(parent, x);
    int yroot = findParent(parent, y);
    if (rank[xroot] < rank[yroot]) parent[xroot] = yroot;
    else if (rank[xroot] > rank[yroot]) parent[yroot] = xroot;
    else {
        parent[yroot] = xroot;
        rank[xroot]++;
    }
}
int compare(const void* a, const void* b) {
    return ((Edge*)a)->weight - ((Edge*)b)->weight;
}
void kruskal(int n, Edge edges[], int* loopCount) {
    int parent[MAX], rank[MAX];
    for (int i = 0; i < n; i++) {
        parent[i] = -1;
        rank[i] = 0;
        (*loopCount)++;
    }
    qsort(edges, n, sizeof(Edge), compare);
    (*loopCount)++;
    int mstWeight = 0;
    printf("Edges in the Minimum Spanning Tree:\n");
    for (int i = 0; i < n; i++) {
        (*loopCount)++;
        int x = findParent(parent, edges[i].u);
        int y = findParent(parent, edges[i].v);
        if (x != y) {
            unionSets(parent, rank, x, y);
            mstWeight += edges[i].weight;
            printf("%d - %d: %d\n", edges[i].u, edges[i].v, edges[i].weight);
        }
    }
    printf("Weight of the Minimum Spanning Tree: %d\n", mstWeight);
}
int main() {
    Edge edges[] = {
        {0, 1, 10}, {0, 2, 6}, {0, 3, 5}, {1, 3, 15}, {2, 3, 4}
    };
    int n = sizeof(edges) / sizeof(edges[0]);
    int loopCount = 0;
    kruskal(n, edges, &loopCount);
    printf("Number of loops: %d\n", loopCount);
    return 0;
}
