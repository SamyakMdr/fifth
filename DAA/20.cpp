#include <stdio.h>
#include <limits.h>
int matrixChainOrder(int p[], int n) {
    int m[n][n];
    int s[n][n];
    int loopCount = 0;
    for (int i = 1; i < n; i++)
        m[i][i] = 0;
    for (int len = 2; len < n; len++) {
        for (int i = 1; i < n - len + 1; i++) {
            int j = i + len - 1;
            m[i][j] = INT_MAX;
            for (int k = i; k < j; k++) {
                loopCount++;
                int q = m[i][k] + m[k+1][j] + p[i-1] * p[k] * p[j];
                if (q < m[i][j]) {
                    m[i][j] = q;
                    s[i][j] = k;
                }
            }
        }
    }
    printf("Loop Count: %d\n", loopCount);
    return m[1][n-1];
}
int main() {
    int arr[] = {1, 2, 3, 4};
    int n = sizeof(arr) / sizeof(arr[0]);
    printf("Minimum number of multiplications is %d\n", matrixChainOrder(arr, n));
    return 0;
}
