{-# OPTIONS -Wall #-}
import Data.Set (Set)
import qualified Data.Set as Set

castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

iterateMods :: String -> [Int]
iterateMods = cycle . map castInt . lines

iterateFrequencies :: [Int] -> [Int]
iterateFrequencies = scanl (+) 0

firstDuplicate :: Set Int -> [Int]  -> Int
firstDuplicate s (new:remaining) =
    if Set.member new s
    then new
    else firstDuplicate (Set.insert new s) remaining

main :: IO ()
main = readFile "input" >>= print . firstDuplicate Set.empty . iterateFrequencies . iterateMods
