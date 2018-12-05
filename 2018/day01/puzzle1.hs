castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

main :: IO ()
main = print . sum . map castInt . lines =<< readFile "input"