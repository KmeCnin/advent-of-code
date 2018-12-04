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
firstDuplicate s freqs =
    if Set.member new s
    then new
    else firstDuplicate (Set.insert new s) remaining
    where
        new = head freqs
        remaining = tail freqs

main :: IO ()
main = readFile "input" >>= print . firstDuplicate Set.empty . iterateFrequencies . iterateMods
