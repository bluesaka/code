# 数据挖掘

* ## 工具：python pandas matplotlib scipy...

* ## 终端
    - ### linux
    ```
    apt-get install Python-numpy Python-scipy Python-matplotlib ipython ipython-notebook Python-pandas Python-sympy Python-nose
    ```

    - ### windows
    ```
    Anaconda 云平台：https://www.continuum.io/downloads
    ```

* ## example

    ```py
    import numpy as np
    import matplotlib.pyplot as plt
    import MySQLdb

    # 打开数据库连接
    db = MySQLdb.connect("localhost", "root", "123456", "test")

    # 使用cursor()方法获取操作游标
    cursor = db.cursor()

    # 使用execute方法执行SQL语句
    cursor.execute("select age from student")

    # 获取结果集
    data = cursor.fetchall()

    # 关闭数据库连接
    db.close()

    ages = {}
    for x in data:
        x = int(x[0])
        if x not in ages:
            ages[x] = 1
        else:
            ages[x] += 1
    # ages ={1: 1, 2: 6, 3: 3, 4: 1, 5: 2, 6: 1, 7: 1, 8: 1, 9: 1, 10: 1, 11: 1, 20: 1}
    keys = ages.keys()
    values = ages.values()

    plt.title('Age Statictics')
    plt.xlabel('age')
    plt.ylabel('number')
    plt.bar(keys, values)
    # plt.bar(keys, values, 0.6, color='r', alpha=0.5)  #0.6为宽度

    plt.show()
    ```

* ## code snippet

    ```py
    import pandas as pd
    import numpy as np
    import matplotlib.pyplot as plt

    ts = pd.Series(np.random.randn(1000), index=pd.date_range('1/1/2000', periods=1000))
    ts = ts.cumsum()
    ts.plot()
    plt.show()  #plt.show(ts) 每次show()之前需要plot()
    ```

    ```py
    import matplotlib.pyplot as plt
    plt.plot([1,2,3,4])
    plt.ylabel('some numbers')
    plt.show()
    ```

    ```py
    import matplotlib.pyplot as plt
    plt.plot([4,8,12,14], [3,6,11,19], 'ro')  #ro为plot的颜色和线条代码，默认是 ‘b-’ 蓝色实线
    plt.axis([0,24,0,20]) # 横坐标0-24, 纵坐标0-20
    plt.show()
    ```

    ```py
    impoty numpy as np
    import matplotlib.pyplot as plt
    t = np.arange(0, 5., 0.2)  #类似range(), 左闭右开[start, end)  [0., 0.2, ..., 4.8]
    plt.plot(t, t, 'r--', t, t**2, 'bs', t, t**3, 'g^')  #t**2 就是t的2次方，[0., 0.04, ..., 4.8*4.8]
    plt.show()
    ```

    ```
    import numpy as np
    import matplotlib.pyplot as plt

    # Fixing random state for reproducibility
    np.random.seed(19680801)

    mu, sigma = 100, 15
    x = mu + sigma * np.random.randn(10000)

    # the histogram of the data
    n, bins, patches = plt.hist(x, 50, normed=1, facecolor='g', alpha=0.75)

    plt.xlabel('Smarts')
    plt.ylabel('Probability')
    plt.title('Histogram of IQ')
    plt.text(60, .025, r'$\mu=100,\ \sigma=15$')
    plt.axis([40, 160, 0, 0.03])
    plt.grid(True)
    plt.show()
    ```