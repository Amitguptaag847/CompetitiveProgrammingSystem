import java.io.*;
import java.io.*;
import java.math.*;
import java.util.*;
import java.util.stream.*;

class test {
    StringTokenizer stok;
    BufferedReader br;
    
    public test() {
        br = new BufferedReader(new InputStreamReader(System.in));
    }

    public String nextToken() throws IOException {
        while (stok == null || !stok.hasMoreTokens()) {
            String s = br.readLine();
            if (s == null) { return null; }
            stok = new StringTokenizer(s);
        }
        return stok.nextToken();
    }
    
    public int nextInt() throws IOException { 
        return Integer.parseInt(nextToken()); 
    }
  
    public static void main(String args[]) throws IOException {
        int n, s;
        
        test reader = new test(); 
        n = reader.nextInt();
        s = reader.nextInt();
        int[] a = new int[n];
        for (int i = 0; i < n; ++i){
            a[i] = reader.nextInt();
        }
        Arrays.sort(a);
        long res = 0;
        if (a[n / 2] < s) {
            for (int i = n / 2; i < n && a[i] < s; ++i)
                res += s - a[i];
        } else {
            for (int i = n / 2; i >= 0 && a[i] > s; --i)
                res += a[i] - s;
        }
        System.out.println(res);
    }
}
