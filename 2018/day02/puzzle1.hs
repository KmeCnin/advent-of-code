import Data.List

truthTuple :: [Int] -> (Bool, Bool)
truthTuple list = (elem 2 list, elem 3 list)

-- Return a tuple where first element is either there is twins letters and
-- the second element is either there is triplets
generateSignature :: String -> (Bool, Bool)
generateSignature = truthTuple . nub . map (length) . group . sort

checksum :: ([Bool], [Bool]) -> Int
checksum tuple = foo * bar
    where
        foo = sum . map fromEnum . fst $ tuple
        bar = sum . map fromEnum . snd $ tuple


main :: IO ()
main = print . checksum . unzip . map generateSignature . lines =<< readFile "input"