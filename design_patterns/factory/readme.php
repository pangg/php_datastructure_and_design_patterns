<?php

/*
 * 1. PHP工厂模式概念：工厂模式是一种类，它具有为您创建对象的某些方法。
 *      您可以使用工厂类创建对象，而不直接使用 new。
 *      这样，如果您想要更改所创建的对象类型，只需更改该工厂即可。
 *      使用该工厂的所有代码会自动更改。
 * 2. 根据抽象程度不同，PHP工厂模式分为：简单工厂模式、工厂方法模式和抽象工厂模式
 *
 * 3. 区别：
 *      简单工厂模式:用来生产同一等级结构中的任意产品。对与增加新的产品，无能为力
 *      工厂模式 ：用来生产同一等级结构中的固定产品。（支持增加任意产品）
 *      抽象工厂 ：用来生产不同产品族的全部产品。（对于增加新的产品，无能为力；支持增加产品族）
 *
 * 4. 以上三种工厂 方法在等级结构和产品族这两个方向上的支持程度不同。所以要根据情况考虑应该使用哪种方法
 * 适用范围：
 *      (1)简单工厂模式：
 *          工厂类负责创建的对象较少，客户只知道传入工厂类的参数，对于如何创建对象不关心。
 *      (2)工厂方法模式：
 *          当一个类不知道它所必须创建对象的类或一个类希望由子类来指定它所创建的对象时，当类将创建对象的职责委托给多个帮助子类中得某一个，并且你希望将哪一个帮助子类是代理者这一信息局部化的时候，可以使用工厂方法模式。
 *      (3)抽象工厂模式：
 *          一个系统不应当依赖于产品类实例何如被创建，组合和表达的细节，这对于所有形态的工厂模式都是重要的。这个系统有多于一个的产品族，而系统只消费其 中某一产品族。同属于同一个产品族的产品是在一起使用的，这一约束必须在系统的设计中体现出来。系统提供一个产品类的库，所有的产品以同样的接口出现，从 而使客户端不依赖于实现。
 * */