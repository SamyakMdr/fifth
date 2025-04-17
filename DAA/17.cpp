#include <stdio.h>
int knapsack(int W, int wt[], int val[], int n) {
    int dp[n+1][W+1];
    int loopCount = 0;
    for (int i = 0; i <= n; i++) {
        for (int w = 0; w <= W; w++) {
            loopCount++;
            if (i == 0 || w == 0)
                dp[i][w] = 0;
            else if (wt[i-1] <= w)
                dp[i][w] = (val[i-1] + dp[i-1][w-wt[i-1]] > dp[i-1][w]) ? (val[i-1] + dp[i-1][w-wt[i-1]]) : dp[i-1][w];
            else
                dp[i][w] = dp[i-1][w];
        }
    }
    printf("Loop Count: %d\n", loopCount);
    return dp[n][W];
}
int main() {
    int val[] = {30, 40, 60};
    int wt[] = {10, 20, 30};
    int W = 50;
    int n = sizeof(val) / sizeof(val[0]);
    printf("Maximum value in Knapsack = %d\n", knapsack(W, wt, val, n));
    return 0;
}
