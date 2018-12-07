import Data.List
import Data.Maybe

-- Either both boxes have only 1 different char
diff :: String -> String -> Bool
diff str1 str2 = 1 == (sum . map fromEnum $ zipWith (/=) str1 str2)

-- Try to find the matching box from a list
match :: String -> [String] -> Maybe String
match needle haystack = find (diff needle) haystack

-- Iterate over all boxes to find the both that match
boxesId :: [String] -> String
boxesId (needle:haystack) = 
    if isJust matched
    then needle `intersect` fromJust matched
    else boxesId haystack
    where
        matched = match needle haystack

main :: IO ()
main = print . boxesId . lines =<< readFile "input"