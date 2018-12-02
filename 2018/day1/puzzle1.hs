module Main where

    castInt :: [Char] -> Int
    castInt ('+':xs) = castInt xs
    castInt string = read string

    main = do
        input <- readFile "input"
        print $ foldl (+) 0 $ map castInt $ lines input