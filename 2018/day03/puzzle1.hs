import Text.Regex.Posix
import Data.List

parse :: String -> (String, String, String, [String])
parse claim = claim =~ "#[0-9]+ @ ([0-9]+),([0-9]+): ([0-9]+)x([0-9]+)" :: (String, String, String, [String])

export :: (String, String, String, [String]) -> (Int, Int, Int, Int)
export (_, _, _, [a, b, c, d]) = (read a, read b, read c, read d)

cover :: (Int, Int, Int, Int) -> [(Int, Int)]
cover (left, top, width, height) = walk [] left top width height 0 0
    where
        walk :: [(Int, Int)] -> Int -> Int -> Int -> Int -> Int -> Int -> [(Int, Int)]
        walk list left top width height x y 
            | nextX < width = walk (list ++ tuple) left top width height nextX y
            | nextY < height = walk (list ++ tuple) left top width height 0 nextY
            | otherwise = (list ++ tuple)
            where
                nextX = x + 1
                nextY = y + 1
                tuple = [(left + x, top + y)]

main :: IO ()
main = print . length . filter (> 1) . map length . group . sort . concat . map cover . map export . map parse . lines =<< readFile "input"