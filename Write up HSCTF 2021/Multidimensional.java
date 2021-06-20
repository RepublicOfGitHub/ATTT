import java.util.Scanner;
import java.util.Arrays;

public class Multidimensional {
	
	private char[][] arr;
	private String mrConnolly;
	
	public Multidimensional(String s) {
		arr = new char[6][6];
		mrConnolly = "hey_since_when_was_time_a_dimension?";
	}
	
	public boolean check() {
		int count = 0;
		for(int dong=0; dong<6; ++dong){
			for(int cot=0; cot<6; ++cot){
				arr[dong][cot] = mrConnolly.charAt(count);
				++count;
			}
		}
		return true;
	}
	
	public void line() {
		char[][] newArr = new char[arr.length][arr[0].length];
		for (int i = arr.length - 1; i >= 0; i--) {
			for (int j = arr[0].length - 1; j >=0 ; j--) {
				int p = i - 1, q = j - 1, f = 0;
				boolean row = i % 2 == 0;
				boolean col = j % 2 == 0;
				if (row) {
					p = i + 1;
					f--;
				} else
					f++;
				if (col) {
					q = j + 1;
					f--;
				} else
					f++;
				newArr[p][q] = (char) (arr[i][j] - f);
			}
		}
		arr = newArr;
	}
	
	public void plane() {
		int n = arr.length;
		for (int i = n-1; i >=0 ; i--) {
			for (int j = n-1; j >= 0; j--) {
				arr[i][j] -= i + n - j;
			}
		}
		for (int i = n-1; i >= n / 2; i--) {
			for (int j = n-1; j >= n / 2; j--) {
				char t = arr[i][j];
				arr[i][j] = arr[n - 1 - j][i];
				arr[n - 1 - j][i] = arr[n - 1 - i][n - 1 - j];
				arr[n - 1 - i][n - 1 - j] = arr[j][n - 1 -i];
				arr[j][n - 1 -i] = t;
			}
		}

	}
	
	public void space(int n) {
		arr[(35 - n) / 6][(35 - n) % 6] += (n / 6) + (n % 6);
		if (n != 35) {
			n++;
			space(n);
		}
	}
	
	public void time() {
		int[][] t = {{8, 65, -18, -21, -15, 55}, 
				{8, 48, 57, 63, -13, 5}, 
				{16, -5, -26, 54, -7, -2}, 
				{48, 49, 65, 57, 2, 10}, 
				{9, -2, -1, -9, -11, -10}, 
				{56, 53, 18, 42, -28, 5}};
		for (int j = 0; j < arr[0].length; j++)
			for (int i = 0; i < arr.length; i++)
				arr[i][j] -= t[j][i];
	}

	public void finalCheck(){
		String str = "";
			for (int i = 35; i >= 0; i--) {
				 str+= arr[i % 6][i / 6];
			}

		byte[] strAsByteArray = str.getBytes();
		byte[] result = new byte[strAsByteArray.length];
		for (int i = 0; i < strAsByteArray.length; i++)
        result[i] = strAsByteArray[strAsByteArray.length - i - 1];
        System.out.println(new String(result));
					//System.out.println(str);

	}
	
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		String s = "zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";  //36 ky tu bat ky, hoac de trong cung duoc
			Multidimensional f = new Multidimensional(s);

			//Reverse Time!
			f.check();
			f.time();
			f.space(0);
			f.plane();
			f.line();
			f.finalCheck();
		in.close();
	}

}
