import Data.List
import Data.Maybe

-- Either both boxes have only 1 different char
match :: String -> String -> Bool
match str1 str2 = (== 1) . sum . map fromEnum $ zipWith (/=) str1 str2

-- Iterate over all boxes to find both that match
boxesId :: [String] -> String
boxesId (needle:haystack) = fromMaybe (boxesId haystack) . find (match needle) $ haystack

main :: IO ()
main = print . boxesId . lines =<< readFile "input"