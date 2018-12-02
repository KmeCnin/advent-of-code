castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

main = do
    input <- readFile "input"
    print $ foldl (+) 0 $ map castInt $ lines input