#include <stdio.h>
#include <stdbool.h>
int count = 0;
bool isSafe(int board[][10], int row, int col, int N) {
    int i, j;
    for (i = 0; i < row; i++)
        if (board[i][col])
            return false;
    for (i = row, j = col; i >= 0 && j >= 0; i--, j--)
        if (board[i][j])
            return false;
    for (i = row, j = col; i >= 0 && j < N; i--, j++)
        if (board[i][j])
            return false;
    return true;
}
void solveNQueen(int board[][10], int row, int N) {
    int loopCount = 0;
    if (row == N) {
        count++;
        return;
    }
    for (int col = 0; col < N; col++) {
        loopCount++;
        if (isSafe(board, row, col, N)) {
            board[row][col] = 1;
            solveNQueen(board, row + 1, N);
            board[row][col] = 0;
        }
    }
    printf("Loop Count for Row %d: %d\n", row, loopCount);
}
int main() {
    int N = 4;
    int board[10][10] = {0};
    solveNQueen(board, 0, N);
    printf("Total Solutions: %d\n", count);
    return 0;
}
