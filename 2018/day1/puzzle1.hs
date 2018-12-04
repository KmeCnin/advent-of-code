castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

main :: IO ()
main = readFile "input" >>= print . sum . map castInt . lines