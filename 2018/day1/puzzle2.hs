import Data.Set (Set)
import qualified Data.Set as Set

castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

iterateMods :: String -> [Int]
iterateMods = cycle . map castInt . lines

iterateFrequencies :: [Int] -> [Int]
iterateFrequencies = scanl (+) 0

firstDuplicate :: [Int]  -> Int
firstDuplicate = go Set.empty
    where
        go :: Set Int -> [Int]  -> Int
        go s (new:remaining) = 
            if Set.member new s
            then new
            else go (Set.insert new s) remaining
    
main :: IO ()
main = readFile "input" >>= print . firstDuplicate . iterateFrequencies . iterateMods
