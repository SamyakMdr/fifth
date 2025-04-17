#include <stdio.h>
int subsetSum(int set[], int n, int sum) {
    int dp[n+1][sum+1];
    int loopCount = 0;
    for (int i = 0; i <= n; i++) {
        for (int j = 0; j <= sum; j++) {
            loopCount++;
            if (j == 0)
                dp[i][j] = 1;  
            else if (i == 0)
                dp[i][j] = 0;  
            else if (set[i-1] <= j)
                dp[i][j] = dp[i-1][j] || dp[i-1][j-set[i-1]];
            else
                dp[i][j] = dp[i-1][j];
        }
    }
    printf("Loop Count: %d\n", loopCount);
    return dp[n][sum]; 
}
int main() {
    int set[] = {3, 34, 4, 12, 5, 2};
    int sum = 9;
    int n = sizeof(set) / sizeof(set[0]);
    if (subsetSum(set, n, sum))
        printf("Subset with given sum exists.\n");
    else
        printf("No subset with given sum exists.\n");
    return 0;
}
