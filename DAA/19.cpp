#include <stdio.h>
#include <limits.h>
#define V 4
#define INF INT_MAX
int tsp(int dist[][V], int visited[], int currPos, int count, int cost, int ans) {
    static int loopCount = 0;
    if (count == V && dist[currPos][0]) {
        ans = (cost + dist[currPos][0] < ans) ? (cost + dist[currPos][0]) : ans;
        return ans;
    }
    for (int i = 0; i < V; i++) {
        if (!visited[i] && dist[currPos][i]) {
            loopCount++;
            visited[i] = 1;
            ans = tsp(dist, visited, i, count + 1, cost + dist[currPos][i], ans);
            visited[i] = 0;
        }
    }
    if (currPos == 0 && count == 1) {
        printf("Loop Count: %d\n", loopCount);
    }
    return ans;
}
int main() {
    int dist[][V] = { {0, 10, 15, 20}, {10, 0, 35, 25}, {15, 35, 0, 30}, {20, 25, 30, 0} };
    int visited[V] = {0};
    visited[0] = 1;
    int ans = INF;
    printf("Minimum cost of travelling salesman: %d\n", tsp(dist, visited, 0, 1, 0, ans));
    return 0;
}